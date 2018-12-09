package include.trap.api;

import org.springframework.data.elasticsearch.repository.ElasticsearchRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface TrapEntryRepository extends ElasticsearchRepository<TrapEntry, Long> {

}
